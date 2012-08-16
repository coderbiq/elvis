<?php

namespace Elivs\Type;

class String
{
    protected $_content     = null;
    protected $_old_content = null;

    public function __construct($_content = null)
    {
        $this->_content = $_content;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getOldContent()
    {
        return $this->_old_content;
    }

    public function setContent($_content)
    {
        if($this->_content !== null)
            $this->_old_content = $this->_content;
        $this->_content = $_content;
        return $this;
    }

    /**
     * 方法 matchAll 对当前文本进行正则解析
     *
     * @param String $_reg 要对当前文件进行正则解析的正则表达式
     * @return Array()
     */
    public function matchAll($reg)
    {
        preg_match_all($reg, $this->_content, $tags);
        $tags = array_unique($tags[1]);

        return $tags;
    }

    /**
     * 方法 replace 对当前文本进行正则替换
     *
     * @param String $_reg 要进行替换匹配的正则
     * @param String|Function $_replace 要替换的内容，可以是字符串或函数
     *      当$_replace 为一个函数进该函数应该接收两个参数
     *      参数一为当前文本的原始字符串
     *      参数二为通过正则解析出的标签
     *
     * @return String 替换后的文本
     */
    public function replace($_reg, $_replace)
    {
        if(is_string($_replace))
            $_text = preg_replace($_reg, $_replace, $this->_content);
        else
        {
            preg_match_all($_reg, $this->_content, $tags);
            $_text = $_replace($this->_content, $tags[1]);
        }

        return $_text;
    }

    public function __tostring()
    {
        return $_content;
    }

}
