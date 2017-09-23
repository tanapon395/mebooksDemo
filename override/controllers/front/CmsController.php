<?php
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
class CmsController extends CmsControllerCore
{
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public static function psversion($part = 1)
    {
        $version = _PS_VERSION_;
        $exp = explode('.', $version);
        if ($part == 1)
        {
            return $exp[1];
        }
        if ($part == 2)
        {
            return $exp[2];
        }
        if ($part == 3)
        {
            return $exp[3];
        }
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function initContent()
    {
        if ($this->psversion() == 7)
        {
            parent::initContent();
            if ($this->assignCase == 1)
            {
                $this->cms->content = $this->returnContent($this->cms->content);
                $this->context->smarty->assign(array(
                    'cms' => $this->objectPresenter->present($this->cms),
                    'psver' => $this->psversion()
                ));
                if ($this->cms->indexation == 0)
                {
                    $this->context->smarty->assign('nobots', true);
                }
                $this->setTemplate('cms/page', array(
                    'entity' => 'cms',
                    'id' => $this->cms->id
                ));
            }
            elseif ($this->assignCase == 2)
            {
                $this->context->smarty->assign($this->getTemplateVarCategoryCms());
                $this->setTemplate('cms/category');
            }
        }
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function returnProduct($id_product)
    {
        $x = (array)new Product($id_product, true, $this->context->language->id);
        $productss[$id_product] = $x;
        $productss[$id_product]['id_product'] = $id_product;
        $products = Product::getProductsProperties($this->context->language->id, $productss);
        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever(
                $this->context->link
            ),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );
        $products_for_template = [];
        foreach ($products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        $this->context->smarty->assign('products', $products_for_template);
        $this->context->smarty->assign('feedtype', "cmsSingleProductFeed");
        return $this->context->smarty->fetch('module:cmsproducts/products.tpl');
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function returnProducts($id_product)
    {
        $explode_products = explode(",", $id_product);
        foreach ($explode_products AS $idp)
        {
            $explode[] = $idp;
            foreach ($explode as $tproduct)
            {
                if ($tproduct != '')
                {
                    $x = (array)new Product($tproduct, true, $this->context->language->id);
                    $productss[$tproduct] = $x;
                    $productss[$tproduct]['id_product'] = $tproduct;
                }
            }
        }
        $products = Product::getProductsProperties($this->context->language->id, $productss);
        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever(
                $this->context->link
            ),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );
        $products_for_template = [];
        foreach ($products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        $this->context->smarty->assign('products', ($this->psversion()==7 ? $products_for_template:$products));
        $this->context->smarty->assign('feedtype', "cmsProductsFeed");
        return $this->context->smarty->fetch('module:cmsproducts/products.tpl');
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function returnProductsHpp($block)
    {
        if (class_exists("Hpp"))
        {
            $hpp = new Hpp();
            if (method_exists($hpp, 'returnProducts'))
            {
                return $this->displayHpp($hpp->returnProducts($block));
            }
            else
            {
                return $this->noModuleMessage("Homepage Products Pro");
            }
        }
        else
        {
            return $this->noModuleMessage("Homepage Products Pro");
        }
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function returnProductsRpp($block)
    {
        if (class_exists("Ppb"))
        {
            $rpp = new Ppb();
            if (method_exists($rpp, 'returnProducts'))
            {
                return $this->displayRpp($rpp->returnProducts($block));
            }
            else
            {
                return $this->noModuleMessage("Related Products Pro");
            }
        }
        else
        {
            return $this->noModuleMessage("Related Products Pro");
        }
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function displayRpp($products)
    {
        if (count($products) <= 0)
        {
            $this->context->smarty->assign('feedtype', "noProducts");
        }
        else
        {
            $this->context->smarty->assign('products', $products);
            $this->context->smarty->assign('feedtype', "rppfeed");
        }
        $contents = $this->context->smarty->fetch('module:cmsproducts/products.tpl');
        return $contents;
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function displayHpp($products)
    {
        if (count($products) <= 0)
        {
            $this->context->smarty->assign('feedtype', "noProducts");
        }
        else
        {
            $this->context->smarty->assign('products', $products);
            $this->context->smarty->assign('feedtype', "hppfeed");
        }
        $contents = $this->context->smarty->fetch('module:cmsproducts/products.tpl');
        return $contents;
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function noModuleMessage($module)
    {
        $products = false;
        $this->context->smarty->assign('products', $products);
        $this->context->smarty->assign('module', $module);
        $this->context->smarty->assign('feedtype', "error");
        $contents = $this->context->smarty->fetch('module:cmsproducts/products.tpl');
        return $contents;
    }
    /*
    * module: cmsproducts
    * date: 2017-09-23 15:27:06
    * version: 1.5.1
    */
    public function returnContent($contents)
    {
        
        preg_match_all('/\{products\:[(0-9\,)]+\}/i', $contents, $matches);
        foreach ($matches[0] as $index => $match)
        {
            $explode = explode(":", $match);
            $contents = str_replace($match, $this->returnProducts(str_replace("}", "", $explode[1])), $contents);
        }
        
        preg_match_all('/\{product\:[(0-9\,)]+\}/i', $contents, $matches);
        foreach ($matches[0] as $index => $match)
        {
            $explode = explode(":", $match);
            $contents = str_replace($match, $this->returnProduct(str_replace("}", "", $explode[1])), $contents);
        }
        
        preg_match_all('/\{hpp\:[(0-9)]+\}/i', $contents, $matches);
        foreach ($matches[0] as $index => $match)
        {
            $explode = explode(":", $match);
            $contents = str_replace($match, $this->returnProductsHpp(str_replace("}", "", $explode[1])), $contents);
        }
        
        preg_match_all('/\{rpp\:[(0-9)]+\}/i', $contents, $matches);
        foreach ($matches[0] as $index => $match)
        {
            $explode = explode(":", $match);
            $contents = str_replace($match, $this->returnProductsRpp(str_replace("}", "", $explode[1])), $contents);
        }
        return $contents;
    }
}