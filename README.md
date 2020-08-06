metallium-api
===============

This is the (alpha) API for Metallium, a metadata repository for
ExploreUK.

Copy .env.example to .env and set deploy directory.  Ensure that
local deploy account sets the following:

* MTL_LOCAL_DIR
* MTL_REMOTE_DIR
* MTL_REMOTE_USER
* MTL_REMOTE_HOST

Deploy with

> exe/mtl-deploy.sh

Licenses
--------

Copyright (C) 2020 M Slone

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
