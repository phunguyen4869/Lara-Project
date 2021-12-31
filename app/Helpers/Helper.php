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
                    <td>' . self::active($category->active) . '</td>
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
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                        <li>
                            <a href="/danhmuc/' . $category->id . '-' . Str::slug($category->name, '-') . '.html">' . $category->name . '</a>';
                            unset($categories[$key]);
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

    public static function active($active = 0)
    {
        return $active == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
    }
}
