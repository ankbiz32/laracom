<?php

namespace App;

class Cart
{
    public $items =[];
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        if(array_key_exists($id,$this->items)){
            $this->totalPrice += $this->items[$id]['item']['price'];
            $this->totalQuantity++;
            $this->items[$id]['quantity'] ++;
        }
        else{
            $storedItem = ['quantity'=>1,'price'=>$item->price,'item'=>$item,'product_id'=>$item->id];
            $this->items[$item->id]=$storedItem;
            $this->totalPrice += $item->price;
            $this->totalQuantity++;
        }
    }

    public function remove($id){
        // dd($this);
        if(isset($this->items[$id])){
            $this->totalPrice -= $this->items[$id]['item']['price'];
            $this->totalQuantity-=$this->items[$id]['quantity'];
            unset($this->items[$id]);
        }
    }

}
