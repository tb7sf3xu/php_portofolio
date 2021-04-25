<?php
  class Goods {
    //プロパティの設定
    private $id;
    private $maker;
    private $name;
    private $price;
    //$count = 在庫数
    private $count;
    //$order = 発注あり、なしの指定
    private $order;
    //$sales = 合計売り上げ
    private $sales;
    //$salesCount = 合計販売個数
    private $salesCount;
    
    /**
     * インスタンス作成時にプロパティに値をセット
     * @param int $id
     * @param string $maker
     * @param string $name
     * @param int $price
     * @param int $count
     * @param string $order
     * @return void
     */
    public function __construct($id, $maker, $name, $price, $count, $order, $sales, $salesCount) {
      $this->id = $id;
      $this->maker = $maker;
      $this->name = $name;
      $this->price = $price;
      $this->count = $count;
      $this->order = $order;
      $this->sales = $sales;
      $this->salesCount = $salesCount;
    }
    
    /**
     * idプロパティの取得
     * @param void
     * @return int $this->id
     */
    public function getId() {
      return $this->id;
    }

    /**
     * nameプロパティの取得
     * @param void
     * @return string $this->name
     */
    public function getName() {
      return $this->name;
    }
    
    /**
     * makerプロパティの取得
     * @param void
     * @return string $this->maker
     */
    public function getMaker() {
      return $this->maker;
    }
    
    /**
     * priceプロパティの取得
     * @param void
     * @return int $this->price
     */
    public function getPrice() {
      return $this->price;
    }
    
    /**
     * countプロパティの取得
     * @param void
     * @return int $this->count
     */
    public function getCount() {
      return $this->count;
    }

    /**
     * orderプロパティの取得
     * @param void
     * @return string $this->order
     */
    public function getOrder() {
      return $this->order;
    }

    /**
     * salesプロパティの取得
     * @param void
     * @return string $this->sales
     */
    public function getSales() {
      return $this->sales;
    }

    /**
     * salesCountプロパティの取得
     * @param void
     * @return string $this->salesCount
     */
    public function getSalesCount() {
      return $this->salesCount;
    }

    /**
     * countプロパティに値をセット
     * @param int $count
     * @return void
     */
    public function setCount($count) {
      $this->count = $count;
    }
    
    /**
     * salesプロパティに値をセット
     * @param void
     * @return void
     */
    public function setSales() {
      $this->sales = $this->getTotalSales();
    }

    /**
     * salesCountプロパティに値をセット
     * @param int $salesCount
     * @return void
     */
    public function setSalesCount($salesCount) {
      $this->salesCount = $salesCount;
      
    }

    /**
     * nameプロパティに一致するインスタンスの取得
     * @param array|string $merchandise|$name
     * @return array $goods
     */
    public static function findByName($merchandise, $name) {
      foreach($merchandise as $goods) {
        if ($goods->getName() === $name) {
          return $goods;
        }
      }
    }

     
  }

?>