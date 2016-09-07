<?php
/**
 * Created by PhpStorm.
 * User: kklaus
 * Date: 9/7/16
 * Time: 7:45 AM
 */

namespace App\Filters;


use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Thumbnail implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(70, 70);
    }
}