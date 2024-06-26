<?php
class SearchController extends SearchControllerCore
{
    public function initContent()
    {
        parent::initContent();

        $search_query = Tools::getValue('search_query', Tools::getValue('ref', Tools::getValue('s')));
        if ($search_query) {
            $results = Search::find($this->context->language->id, $search_query);
            if ($results && count($results) === 1) {
                $result = reset($results);
                $product_url = $this->context->link->getProductLink($result['id_product'], null, null, null, null, null, $result['id_product_attribute']);
                Tools::redirect($product_url);
            }
        }
    }
}
