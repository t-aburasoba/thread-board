<?php

namespace App\Repositories;

use App\Image;

class ImageRepository
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * ImageRepository constructor.
     *
     * @param Image $Image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Create new Image.
     *
     * @param array $data
     * @return Image $image
     */
    public function create(array $data)
    {
        return $this->image->create($data);
    }
}
