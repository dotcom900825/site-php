chmod 500 *.php
echo "home directory done"
cd lib/ws
chmod 500 *.php
echo "lib/ws directory done"
cd ../../Client
chmod -R 500 */*.php
echo "file permission change done"
