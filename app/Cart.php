<?php

namespace App;
use App\Product;

class Cart
{
    public $items = [];
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $variant = null;
        $variant_name = null;

        if (isset($_GET['attr'])) {
            $variant = $_GET['attr'];
            $variant_name = $item->productAttribute->filter(function ($i) {
                                return $i->attribute_detail_id == (int)$_GET['attr'];
                            })->first()->attribute->name 
                            . ': ' .
                            $item->productAttribute->filter(function ($i) {
                                return $i->attribute_detail_id == (int)$_GET['attr'];
                            })->first()->attributeDetail->name;
            if ($item->ProductDiscount->has_discount) {
                if ($item->ProductDiscount->type == 'FLAT') {
                    $price = $item->ProductDiscount->rate;
                } else {
                    $tmpprice = $item->productAttribute->filter(function ($i) {
                        return $i->attribute_detail_id == (int)$_GET['attr'];
                    })->first()->attribute_price;

                    $price = ((100 - $item->ProductDiscount->rate) / 100) * $tmpprice;
                }
            } else {
                $price = $item->productAttribute->filter(function ($i) {
                    return $i->attribute_detail_id == (int)$_GET['attr'];
                })->first()->attribute_price;
            }
        } else {
            $price = $item->price;
            if ($item->ProductDiscount->has_discount) {
                if ($item->ProductDiscount->type == 'FLAT') {
                    $price = $item->ProductDiscount->rate;
                } else {
                    $price = ((100 - $item->ProductDiscount->rate) / 100) * $item->price;
                }
            }
        }

        $variant ?  $res = $this->in_array_var($id, $this->items, $variant) : $res = $this->in_array_abs($id, $this->items);
        if (is_null($res)) {
            $storedItem = [
                'quantity' => 1,
                'price' => $price,
                'item' => $item,
                'product_id' => $item->id,
                'product_variant' => $variant,
                'product_variant_name' => $variant_name
            ];
            $this->items[] = $storedItem;
            $this->totalPrice += round($price);
            $this->totalQuantity++;
        } else {
            $this->totalPrice += $price;
            $this->totalQuantity++;
            $this->items[$res]['quantity']++;
        }
    }

    public function update($id, $qty, $variant)
    {
        $product = Product::find($id);
        $key= null;
        $other_variant_qty= 0;
        $qt = 0;
        if($variant){
            foreach($this->items as $k=>$fa){
                if($fa['product_id'] == $id){
                    $qt+=$fa['quantity'];
                    if($fa['product_variant'] == $variant){
                        $key=$k;
                    }
                    else{
                        $other_variant_qty=$fa['quantity'];
                    }
                }
            }
            if($qt <= $product->max_order_qty){
                if(($qty+$other_variant_qty) <= $product->max_order_qty){
                    $this->totalPrice = $this->totalPrice - $this->items[$key]['price'] * $this->items[$key]['quantity'] + $this->items[$key]['price'] * $qty;
                    $this->totalQuantity = $this->totalQuantity - $this->items[$key]['quantity'] + $qty;
                    $this->items[$key]['quantity'] = $qty;
                }
            }
        }
        else{
            foreach($this->items as $k=>$fa){
                if($fa['product_id'] == $id){
                    $qt+=$fa['quantity'];
                    $key=$k;
                }
            }
            if($qty <= $product->max_order_qty){
                $this->totalPrice = $this->totalPrice - $this->items[$key]['price'] * $this->items[$key]['quantity'] + $this->items[$key]['price'] * $qty;
                $this->totalQuantity = $this->totalQuantity - $this->items[$key]['quantity'] + $qty;
                $this->items[$key]['quantity'] = $qty;
            }
        }

      

        // if (array_key_exists($id, $this->items)) {
        //     $this->totalPrice = $this->totalPrice - $this->items[$id]['price'] * $this->items[$id]['quantity'] + $this->items[$id]['price'] * $qty;
        //     $this->totalQuantity = $this->totalQuantity - $this->items[$id]['quantity'] + $qty;
        //     $this->items[$id]['quantity'] = $qty;
        // }
    }

    public function remove($id)
    {
        // dd($this);
        if (isset($this->items[$id])) {
            $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['quantity'];
            $this->totalQuantity -= $this->items[$id]['quantity'];
            unset($this->items[$id]);
        }
    }

    public function in_array_var($needle, $haystack, $variant)
    {
        $r = null;
        foreach ($haystack as $key => $item) {
            if ($item['product_id'] == $needle && $item['product_variant'] == $variant) {
                $r = $key;
            }
        }
        return $r;
    }

    public function in_array_abs($needle, $haystack)
    {
        $r = null;
        foreach ($haystack as $key => $item) {
            if ($item['product_id'] == $needle) {
                $r = $key;
            }
        }
        return $r;
    }
}
