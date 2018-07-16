<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BundleProduct;
use App\Product;

class BundleProductController extends Controller
{
    public function getProductsIncludedInBundle($bundleid) 
    {

        $products = [];
        $bundleProducts = BundleProduct::where('bundle_id', $bundleid)->get();
        foreach($bundleProducts as $i)
        {
            $product = Product::find($i->product_id);
            array_push($products, $product);
        }

        return response()->json($products);
    }

    public function getProductsNotIncludedInBundle($bundleid)
    {
        $allProducts = Product::all();
        $products = [];
        foreach($allProducts as $i)
        {
            if(BundleProduct::where
            ([
                ['bundle_id', $bundleid],
                ['product_id', $i->id]
            ])->doesntExist()) {
                array_push($products, $i);
            }
        }

        return response()->json($products);

    }

    public function addProductToBundle($bundleid, $productid) 
    {
        $bundleProduct = new BundleProduct();
        $bundleProduct->bundle_id = $bundleid;
        $bundleProduct->product_id = $productid;
        $bundleProduct->save();
        return response()->json($bundleProduct);
        
    }

    public function removeProductFromBundle($bundleid, $productid)
    {
        $bundleProduct = BundleProduct::where([
            ['bundle_id', $bundleid],
            ['product_id', $productid]
        ]);

        $bundleProduct->delete();
    }
}
