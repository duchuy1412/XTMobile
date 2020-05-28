<?php

  namespace API\GetProductById\Api;

  /**
   * interface get product data API XML by product id
   */
  interface ProductInterface
  {
    /**
     * @api
     * @param string $id Product id.
     * @return string product data
     */
    public function getProductById($id);
  }