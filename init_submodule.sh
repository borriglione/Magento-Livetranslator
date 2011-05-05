#!/bin/bash

echo "initializing submodule in magento"
MODULE_DIR=$(cd `dirname $0` && pwd)
MAGE_DIR=$MODULE_DIR/../../magento/htdocs

echo "Module directory: $MODULE_DIR"

CONTRIBUTOR=`ls app/etc/modules/ | sed 's/_.*\.xml//'`
MODULE=`ls app/etc/modules/ | sed 's/.*\_//' | sed 's/.xml//'`

echo "*** start initializing of $CONTRIBUTOR $MODULE"

LC_CONTRIBUTOR=`echo $MODULE|awk '{print tolower($CONTRIBUTOR)}'`
LC_MODULE=`echo $MODULE|awk '{print tolower($MODULE)}'`

LINKS=( \
  "app/code/community/$CONTRIBUTOR/$MODULE"
  "app/code/local/$CONTRIBUTOR/$MODULE"
  "app/etc/modules/"$CONTRIBUTOR"_$MODULE.xml"
  "app/design/adminhtml/default/default/layout/$LC_MODULE.xml"
  "app/design/adminhtml/default/default/layout/$LC_MODULE"
  "app/design/adminhtml/default/default/layout/$LC_CONTRIBUTOR/$LC_MODULE.xml"
  "app/design/adminhtml/default/default/template/$LC_MODULE"
  "app/design/adminhtml/default/default/template/$LC_CONTRIBUTOR/$LC_MODULE"
  "app/design/frontend/base/default/layout/$LC_MODULE.xml"
  "app/design/frontend/base/default/layout/$LC_MODULE"
  "app/design/frontend/base/default/layout/$LC_CONTRIBUTOR/$LC_MODULE.xml"
  "app/design/frontend/base/default/template/$LC_MODULE"
  "app/design/frontend/base/default/template/$LC_CONTRIBUTOR/$LC_MODULE"
  "app/locale/de_DE/"$CONTRIBUTOR"_$MODULE.xml"
  "app/locale/en_US/"$CONTRIBUTOR"_$MODULE.xml"
  "app/locale/de_DE/$LC_CONTRIBUTOR/$LC_MODULE.xml"
  "app/locale/en_US/$LC_CONTRIBUTOR/$LC_MODULE.xml"
  "js/$LC_MODULE.xml"
  "js/"$LC_CONTRIBUTOR"/$LC_MODULE.xml"
  "skin/adminhtml/default/default/css/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/adminhtml/default/default/css/$LC_MODULE.css"
  "skin/adminhtml/default/default/css/$LC_MODULE"
  "skin/adminhtml/default/default/images/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/adminhtml/default/default/images/$LC_MODULE"
  "skin/adminhtml/default/default/js/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/adminhtml/default/default/js/$LC_MODULE.css"
  "skin/adminhtml/default/default/js/$LC_MODULE"
  "skin/frontend/base/default/css/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/frontend/base/default/css/$LC_MODULE.css"
  "skin/frontend/base/default/css/$LC_MODULE"
  "skin/frontend/base/default/images/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/frontend/base/default/images/$LC_MODULE"
  "skin/frontend/base/default/js/$LC_CONTRIBUTOR/$LC_MODULE"
  "skin/frontend/base/default/js/$LC_MODULE"
)

while [ ! -f $MAGE_DIR/index.php ]; do
  echo "please enter path to the document root of your magento shop:"
  read MAGE_DIR
done
echo ""
echo "creating up to ${#LINKS[@]} symbolic links in $MAGE_DIR"

for LINK in "${LINKS[@]}"; do
  if [ -a "$MODULE_DIR/$LINK" ]; then
    if [ -L "$MAGE_DIR/$LINK" ]; then
      echo " - ignoring $LINK: symlink already exists."
    elif [[ -f "$MAGE_DIR/$LINK" || -d "$MAGE_DIR/$LINK" ]]; then
      echo " - skipping $LINK: file/folder already exists (no symlink)."
    else
      REQUIRED_PARENT_DIR=${LINK/\/$CONTRIBUTOR\/$MODULE/\/$CONTRIBUTOR/}
echo $REQUIRED_PARENT_DIR
   #   REQUIRED_PARENT_DIR=`dirname $REQUIRED_PARENT_DIR`
#echo $REQUIRED_PARENT_DIR
#exit
      if [ -d $REQUIRED_PARENT_DIR ]; then
        if [ -d $REQUIRED_PARENT_DIR ]; then
          mkdir -p $MAGE_DIR/$REQUIRED_PARENT_DIR
          echo " - created parent folder $REQUIRED_PARENT_DIR"
        fi
      fi
      ln -s -t $MAGE_DIR/$REQUIRED_PARENT_DIR $MODULE_DIR/$LINK
      echo " - created symbolic link $LINK"
    fi
  fi
done

if [ -a "$MODULE_DIR/lib" ]; then
  for LINK in `ls "$MODULE_DIR/lib"`; do
    LINK="lib/$LINK"
    if [ -L "$MAGE_DIR/$LINK" ]; then
      echo " - ignoring $LINK: symlink already exists."
    elif [[ -f "$MAGE_DIR/$LINK" || -d "$MAGE_DIR/$LINK" ]]; then
      echo " - skipping $LINK: file/folder already exists (no symlink)."
    else
      ln -s -t $MAGE_DIR/lib $MODULE_DIR/$LINK
      echo " - created symbolic link $LINK"
    fi
  done
fi
