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
                    <td>' . $menu->description . '</td>
                    <td>' . $menu->content . '</td>
                    <td>' . $menu->active . '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="admin/menus/edit/' . $menu->id . '">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('.$menu->id.', \'/admin/menus/destroy\')">
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
}
