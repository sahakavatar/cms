<?php namespace Sahakavatar\Cms\Models\Themes;

use File;
use Sahakavatar\Cms\Models\Templates\Eloquent\Abstractions\TplVariations;

class ThemeVariations extends TplVariations
{
    public static function delete($id, $tpl)
    {
        $vPath = $tpl->path . DS . $tpl->variationPath . 'variations' . DS . $id . '.json';
        if (File::exists($vPath)) return File::delete($vPath);
        return false;
    }

    /**
     * @param array $arg
     */
    public function renderVariation(array $arg = [])
    {

    }

    /**
     * @param $tpl
     * @param $id
     * @return null
     */
    public function findVarition($tpl, $id)
    {
        $path = $tpl->path . '/' . 'variations/' . $id . '.json';
        if (\File::exists($path)) {
            $all = new $this;
            $all->template = $tpl->slug;
            $all->id = \File::name($path);
            $all->path = $tpl->path . '/' . 'variations/';
            $all->file = $path;
            $all->attributes = json_decode(\File::get($path), true);
            $all->original = $all->attributes;
            $all->updated_at = \File::lastModified($path);
            return $all;
        }
        return null;
    }

    /**
     * @param $tpl
     * @param $array
     * @return mixed
     */
    public function createVariation($tpl, $array)
    {
        $id = $tpl->slug . '.' . uniqid();
        $path = $tpl->path . '/' . 'variations/' . $id . '.json';
        $array['id'] = $id;
        $all = new $this;
        $all->id = $id;
        $all->path = $path;
        if (!isset($array['settings'])) {
            $array['settings'] = [];
        }
        $all->attributes = $array;
        $all->original = $all->attributes;
        $all->updated_at = time();
        $array[] = $all;
        return $all;

    }

    /**
     * @return mixed|null
     */
    public function makeInActiveVariation()
    {
        $data = $this->attributes;
        $data['active'] = false;
        $this->attributes = $data;
        return $this;
    }
}