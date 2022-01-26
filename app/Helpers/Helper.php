<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function categories($categories, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '<tr>
                    <td>' . $category->id . '</td>
                    <td>' . $char . $category->name . '</td>
                    <td>' . self::parentCategory($category->parent_id) . '</td>
                    <td>' . $category->description . '</td>
                    <td>' . $category->content . '</td>
                    <td>' . self::active($category->active, 'categories', $category->id) . '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/' . $category->id . '">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow(' . $category->id . ', \'/admin/categories/destroy\')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                ';
                unset($categories[$key]);

                $html .= self::categories($categories, $category->id, $char . '-');
            }
        }
        return $html;
    }

    public static function headerCategories($categories, $parent_id = 0, $isMobile = false)
    {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                        <li>
                            <a href="/category/' . $category->id . '-' . $category->slug . '">' . $category->name . '</a>';
                if (self::isChild($categories, $category->id) && $isMobile == false) {
                    $html .= '<ul class="sub-menu">' . self::headerCategories($categories, $category->id) . '</ul>';
                } elseif (self::isChild($categories, $category->id) && $isMobile == true) {
                    $html .= '<ul class="sub-menu-m">' . self::headerCategories($categories, $category->id) . '</ul>';
                    $html .= '<span class="arrow-main-menu-m">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>';
                }
                $html .= '</li>';
            }
        }
        return $html;
    }

    public static function isChild($categories, $id)
    {
        foreach ($categories as $category) {
            if ($category->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function parentCategory($id = 0)
    {
        return $id == 0 ? 'Root' : $id;
    }

    public static function active($active = 0, $location = null, $id = null)
    {
        return $active == 1 ? '<span class="badge badge-success product-active-btn" style="cursor: pointer" onclick="changeStatus(' . $id . ', \'/admin/' . $location . '/changeStatus\', 0)">Active</span>' : '<span class="badge badge-danger product-active-btn" style="cursor: pointer" onclick="changeStatus(' . $id . ', \'/admin/' . $location . '/changeStatus\', 1)">Inactive</span>';
    }

    public static function separateImage($images, $location = 0)
    {
        $image = explode(',', $images);
        return $image[$location];
    }

    public static function breadcrumb($categories, $id)
    {
        $breadcrumb = '';
        foreach ($categories as $category) {
            if ($category->id == $id) {
                $breadcrumb .= self::breadcrumb($categories, $category->parent_id);
                //$breadcrumb .= '<li class="breadcrumb-item"><a href="/category/' . $category->id . '-' . $category->slug . '">' . $category->name . '</a></li>';
                $breadcrumb .= '<a href="https://shop.test/category/' . $category->id . '-' . $category->slug . '"
                class="stext-109 cl8 hov-cl1 trans-04">
                ' . $category->name . '
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>';
            }
        }
        return $breadcrumb;
    }

    public static function price($price, $price_sale){
        if($price_sale > 0){
            return $price_sale;
        }else{
            return $price;
        }
    }
}
