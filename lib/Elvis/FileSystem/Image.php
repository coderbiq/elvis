<?php

namespace Elvis\FileSystem;

class Image
{
    protected $_file = null;
    protected $_image = null;

    public function __construct(File $_file)
    {
        $this->_file = $_file;
        $this->read();
    }

    public function getFile()
    {
        return $this->_file;
    }

    public function getType()
    {
        return exif_imagetype($this->getFile()->getFullName());
    }

    public function getMimeType()
    {
        return image_type_to_mime_type($this->getType());
    }

    public function read()
    {
        $function = null;

        switch($this->getType())
        {
            case IMAGETYPE_GIF:
                $function = 'ImageCreateFromGIF';
                break;
            case IMAGETYPE_JPEG:
                $function = 'ImageCreateFromJpeg';
                break;
            case IMAGETYPE_PNG:
                $function = 'ImageCreateFromPNG';
                break;
        }

        if($function === null)
            throw new Exception('不允许的文件格式');

        if(!function_exists($function))
            throw new Exception('缺少必要的系统支持');

        $this->_image = $function($this->getFile()->getFullName());

        return $this->_image;
    }

    public function resize(Array $_config = array())
    {
        $src_width = ImageSX($this->_image);
        $src_height = ImageSY($this->_image);

        $new_image = ImageCreateTrueColor($_config['width'], $_config['height']);
        ImageCopyResampled($new_image, $this->_image, 0, 0, 
            $_config['x'], $_config['y'], $_config['width'], $_config['height'],
            $_config['width'], $_config['height']
        );
        $this->_image = $new_image;
        return $this;
    }

    /**
     * @TODO 旋转后的图片质量为下降
     */
    public function rotate($_degrees = 90)
    {
        $this->_image = imagerotate($this->_image, $_degrees, 0);
        return $this;
    }

    public function save()
    {
        $this->output($this->getFile()->getFullName());
    }

    public function output($_file_name = null)
    {
        $function = null;
        switch($this->getType())
        {
            case IMAGETYPE_GIF:
                $function = 'ImageGif';
                break;
            case IMAGETYPE_JPEG:
                $function = 'ImageJpeg';
                break;
            case IMAGETYPE_PNG:
                $function = 'ImagePng';
                break;
        }

        if($function === null)
            throw new Exception('不允许的文件格式');

        if(!function_exists($function))
            throw new Exception('缺少必要的系统支持');

        $function($this->_image, $_file_name);
    }
}
