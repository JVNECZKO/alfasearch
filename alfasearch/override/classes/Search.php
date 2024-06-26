<?php
class Search extends SearchCore
{
    public static function find($id_lang, $expr, $page_number = 1, $page_size = 10, $order_by = 'position', $order_way = 'desc', $ajax = false, $use_cookie = true)
    {
        $sql = '
        (SELECT p.id_product, pl.name, p.reference, p.price, pa.id_product_attribute, pa.reference as combination_reference, pa.mpn as combination_mpn
        FROM '._DB_PREFIX_.'product p
        LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (p.id_product = pl.id_product AND pl.id_lang = '.(int)$id_lang.')
        LEFT JOIN '._DB_PREFIX_.'product_attribute pa ON (p.id_product = pa.id_product)
        WHERE pa.reference LIKE \'%'.pSQL($expr).'%\'
        OR pa.mpn LIKE \'%'.pSQL($expr).'%\')
        UNION
        (SELECT p.id_product, pl.name, p.reference, p.price, 0 as id_product_attribute, p.reference as combination_reference, p.mpn as combination_mpn
        FROM '._DB_PREFIX_.'product p
        LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (p.id_product = pl.id_product AND pl.id_lang = '.(int)$id_lang.')
        WHERE p.reference LIKE \'%'.pSQL($expr).'%\'
        OR p.mpn LIKE \'%'.pSQL($expr).'%\')';
        
        $result = Db::getInstance()->executeS($sql);
        
        if (!$result) {
            return [];
        }

        return $result;
    }
}
