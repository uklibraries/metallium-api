#!/bin/bash
product=metallium.tar.gz
MTL_REMOTE_PARENT=$(dirname "$MTL_REMOTE_DIR")
cd "$MTL_LOCAL_DIR"
bash exe/build.sh
rsync -avPO "dist/$product" "$MTL_REMOTE_USER@$MTL_REMOTE_HOST:$MTL_REMOTE_PARENT/"
ssh "$MTL_REMOTE_USER@$MTL_REMOTE_HOST" "mkdir -p $MTL_REMOTE_DIR; cd $MTL_REMOTE_DIR; tar xf ../$product"
