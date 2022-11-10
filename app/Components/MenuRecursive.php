<?php

namespace App\Components;

use App\Menu;

class MenuRecursive
{
    private $data;
    private $htmlSelect = "";

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function menuRecursive($parent_id, $id = 0, $text = '')
    {
        foreach ($this->data as $item) {
            if ($item['parent_id'] == $id) {
                if ($parent_id == $item['id'] && !empty($parent_id)) {
                    $this->htmlSelect .= "<option selected value='" . $item['id'] . "'>" . $text . $item['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $item['id'] . "'>" . $text . $item['name'] . "</option>";
                }
                $this->menuRecursive($parent_id, $item['id'], $text . '-');
            }
        }
        return $this->htmlSelect;
    }
}
