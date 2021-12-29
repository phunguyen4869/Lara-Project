<?php

namespace App\Helpers;

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

    public static function parentCategory($id = 0)
    {
        return $id == 0 ? 'Root' : $id;
    }

    public static function active($active = 0)
    {
        return $active == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
    }
}
