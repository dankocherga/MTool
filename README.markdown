Mtool
=======

Mtool is a magento code-genarator which should help magento-developers with their daily tasks. It uses zend tool framework.

Installation
------------
Installation instructions for linux systems:
1. Download ZF (minimal package at http://framework.zend.com/download/latest)
2. Extract ZF archive somewhere like ~/lib/ZendFramework
3. Create symbolic link to ZF: ln -s ~/lib/ZendFramework/bin/zf.sh /usr/local/bin/zf
4. Execute "zf --help"  and ensure it works
5. Download mtool archive
6. Extract it to the ZF library directory ~/lib/ZendFramework/library
7. Under the home directory create file ~/.zf
8. Paste the following 2 lines inside:
    php.include_path = ".:~/lib/ZendFramework/library:/usr/bin/pear"
    basicloader.classes.1 = "MtoolManifest"
9. Execute "zf test mtool" to ensure it works

Documentation
-------------
### create module
Syntax
    zf create mage_module
It will ask for:
*   Company name (Mycompany)
*   Module name (Mymodule)
Currently this tool does not support modules without company
It will create:
*   Folder app/code/local/Company/Mymodule/etc
*   File config.xml with default content
*   File app/etc/modules/Company_Mymodule.xml with default content

### create model
Syntax:
    zf create mage_model

Will ask for:
*   module: Company/Mymodule
*   model path: mymodule/trololo_upyachka

Will create:
*   Folder app/code/local/Company/Mymodule/Model if not exist
*   File app/code/local/Company/Mymodule/Model/Trololo/Upyachka.php with class content
*   Models namespace mymodule in the module config.xml if not exists

### create block
Syntax:
    zf create mage_block

Will ask for:
*   module: Company/Mymodule
*   block path: mymodule/trololo_upyachka

Will create:
*   Folder app/code/local/Company/Mymodule/Block if not exist
*   File app/code/local/Company/Mymodule/Block/Trololo/Upyachka.php with class content
*   Blocks namespace mymodule in the module config.xml if not exists

### create helper
Syntax:
    zf create mage_helper

Will ask for:
*   module: Company/Mymodule
*   helper path: mymodule/trololo_upyachka

Will create:
*   Folder app/code/local/Company/Mymodule/Helper if not exist
*   File app/code/local/Company/Mymodule/Helper/Trololo/Upyachka.php with class content
*   Helpers namespace mymodule in the module config.xml if not exists

### rewrite model
Syntax:
    zf rewrite mage_model

Will ask for:
*   module: Company/Mymodule
*   rewrite model path: catalog/product
*   your model path (without namespace): catalog_product

Will create:
*   Folder app/code/local/Company/Mymodule/Model if not exist
*   File app/code/local/Company/Mymodule/Model/Catalog/Product.php with class content
*   Rewrite rules in the module config.xml

### rewrite block
Syntax:
    zf rewrite mage_block

Will ask for:
*   module: Company/Mymodule
*   rewrite block path: catalog/product_view
*   your block path (without namespace): catalog_product_view

Will create:
*   Folder app/code/local/Company/Mymodule/Block if not exist
*   File app/code/local/Company/Mymodule/Block/Catalog/Product/View.php with class content
*   Rewrite rules in the module config.xml

### rewrite helper
Syntax:
    zf rewrite mage_helper

Will ask for:
*   module: Company/Mymodule
*   rewrite block path: customer/data
*   your block path (without namespace): customer_data

Will create:
*   Folder app/code/local/Company/Mymodule/Helper if not exist
*   File app/code/local/Company/Mymodule/Helper/Customer/Data.php with class content
*   Rewrite rules in the module config.xml