#!/bin/bash
composer install
product="metallium.tar.gz"
rm -rf "dist"
mkdir -p "dist/pack"
rsync -crlpt "app/" "dist/pack/app/"
rsync -crlpt "public/" "dist/pack/public/"
rsync -crlpt "vendor/" "dist/pack/vendor/"
rsync -crlpt ".env" "dist/pack/"
cd "dist/pack"
find . -type f -name "*.swp" | xargs -n 1 --no-run-if-empty rm
tar zcf "../$product" .
cd "../.."
echo "Export stored in dist/$product"
