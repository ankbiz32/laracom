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
            $price = $item->price;
            if($item->ProductDiscount->has_discount){
                if($item->ProductDiscount->type=='FLAT'){
                    $price = $item->ProductDiscount->rate;
                }
                else{
                    $price = ( (100 - $item->ProductDiscount->rate) / 100 ) * $item->price;
                }
            }
            $storedItem = ['quantity'=>1,
                            'price'=>$price,
                            'item'=>$item,
                            'product_id'=>$item->id
                        ];
            $this->items[$item->id]=$storedItem;
            $this->totalPrice += $price;
            $this->totalQuantity++;
        }
    }

    public function update($id, $qty){
        if(array_key_exists($id, $this->items)){
            $this->totalPrice = $this->totalPrice - $this->items[$id]['price']*$this->items[$id]['quantity'] + $this->items[$id]['price']*$qty;
            $this->totalQuantity = $this->totalQuantity - $this->items[$id]['quantity'] + $qty;
            $this->items[$id]['quantity'] = $qty;
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
