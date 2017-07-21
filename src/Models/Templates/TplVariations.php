<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/10/2016
 * Time: 5:24 PM
 */

namespace Sahakavatar\Cms\Models\Templates;

use Sahakavatar\Cms\Models\Templates\Eloquent\Abstractions\TplVariations as variations;
use File;

class TplVariations extends variations
{
    /**
     * @return mixed
     */
    public function section()
    {
        return $this->belongsTo('App\Modules\Sections\Sections', 'section_id');
    }

    /**
     * @param array $arg
     * @return mixed
     */
    public function renderVariation(array $arg = [])
    {
        $slug = explode('.', $this->id);
        return Templates::find($slug[0])->render(['variation' => $this->settings, 'args' => $arg]);
    }

    public function findVarition($tpl, $id)
    {
        $path =base_path($tpl->path . '/' . $tpl->variationPath .'/'.$id . '.json');
        if (File::exists($path)) {
            $all = new $this;
            $all->id = File::name($path);
            $all->path = $path;
            $all->file = '';
            $all->attributes = json_decode(File::get($path), true);
            $all->original = $all->attributes;
            $all->updated_at = File::lastModified($path);
            return $all;
        }
        return null;
    }
    public function createVariation($tpl, $array)
    {
        $id = $tpl->slug . '.' . uniqid();
        $path = $tpl->path . '/' . $tpl->variationPath . '/' . $id . '.json';
        $array['id'] = $id;
        $all = new $this;
        $all->id = $id;
        $all->path = $path;
        $all->attributes = $array;
        $all->original = $all->attributes;
        $all->updated_at = time();
        $array[] = $all;
        return $all;

    }
}