<?php
namespace Metallium;

class Metallium
{
    private $config;

    public function __construct()
    {
        $this->config = array(
            'base' => '',
        );
        if (realpath(MTL_BASE_DIR) !== realpath($_SERVER['DOCUMENT_ROOT'])) {
            $this->config['base'] = basename(MTL_BASE_DIR) . '/';
        }
    }

    private function configure()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        $this->config['node'] = $_ENV['MTL_NODE'];
        $this->config['mips_dir'] = $this->config['node'] . '/mips';
    }

    public function run()
    {
        $this->configure();
        if (isset($_SERVER['HTTP_HOST'])) {
            $this->config['host'] = $_SERVER['HTTP_HOST'];
        } else {
            $this->config['host'] = $_SERVER['SERVER_NAME'];
        }

        $request_uri = strtok($_SERVER['REQUEST_URI'], '?');
        $query_string = $_SERVER['QUERY_STRING'];

        $base = $this->config['base'];

        if (preg_match("#^/{$base}(metallium/)?documents/(?<id>[^/]+)#", $request_uri, $matches)) {
            $result = $this->getDocument($matches['id']);
        } elseif (preg_match("#^/{$base}(metallium/)?vocabularies/(?<vocabulary>[^/]+)#", $request_uri, $matches)) {
            $result = $this->getVocabulary($matches['vocabulary']);
        } else {
            $result = array("error" => "Action not permitted.");
        }

        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function getDocument($doc_id)
    {
        $mip_id = preg_replace('/_.*/', '', $doc_id);
        $mip_dir = mip_dir($this->config['mips_dir'], $mip_id);

        if (!is_dir($mip_dir)) {
            return array("error" => "MIP not found.");
        }

        $document = "$mip_dir/docs/$doc_id";

        if (!file_exists($document)) {
            return array("error" => "Document not found in MIP.");
        }

        return json_decode(file_get_contents($document), true);
    }

    public function getVocabulary($vocabularyName) {
        $vocabulary = array();
        # XXX: hardcode this until it is editable --mps 2020-08-06
        if ("format" === $vocabularyName) {
            $vocabulary = array(
                "16mm (photographic film size)",
                "annual reports",
                "architectural drawings (visual works)",
                "archival material",
                "athletic publications",
                "booklets",
                "books",
                "bulletins",
                "collections",
                "course catalogs",
                "diaries",
                "directories",
                "drawings (visual works)",
                "guidebooks",
                "handscrolls",
                "images",
                "indexes (reference sources)",
                "journals",
                "ledgers",
                "maps",
                "minutes",
                "newsletters",
                "newspapers",
                "posters",
                "programs (documents)",
                "yearbooks",
            );
        };
        return $vocabulary;
    }
}
