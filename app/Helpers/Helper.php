<?php

namespace App\Helpers;

class Helper
{
    public static function menus($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '<tr>
                    <td>' . $menu->id . '</td>
                    <td>' . $char . $menu->name . '</td>
                    <td>' . self::parentMenu($menu->parent_id) . '</td>
                    <td>' . $menu->description . '</td>
                    <td>' . $menu->content . '</td>
                    <td>' . self::active($menu->active) . '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/' . $menu->id . '">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                ';
                unset($menus[$key]);

                $html .= self::menus($menus, $menu->id, $char . '-');
            }
        }
        return $html;
    }

    public static function parentMenu($id = 0)
    {
        return $id == 0 ? 'Root' : $id;
    }

    public static function active($active = 0)
    {
        return $active == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
    }
}
