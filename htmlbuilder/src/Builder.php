<?php
/**
 * Created by PhpStorm.
 * User: martijn
 * Date: 12-Jun-17
 * Time: 20:42
 */

namespace jager\HTMLBuilder;

use Mockery\Exception;


class Builder
{
    // Only tags supported in HTML5
    protected $elements = ['html', 'head', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'a', 'abbr', 'address', 'area', 'article', 'aside', 'audio',
        'b', 'base', 'bdi', 'bdo', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption',
        'cite', 'code', 'col', 'colgroup', 'datalist', 'dd', 'del', 'details', 'dfn', 'dialog',
        'div', 'dl', 'dt', 'em', 'embed', 'fieldset', 'figcaption', 'figure', 'footer', 'form',
        'header', 'hr', 'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend',
        'li', 'link', 'main', 'map', 'mark', 'menu', 'menuitem', 'meta', 'nav', 'noscript', 'object',
        'ol', 'optgroup', 'option', 'output', 'p', 'param', 'picture', 'pre', 'progress', 'q',
        'rp', 'rt', 'ruby', 's', 'samp', 'script', 'section', 'select', 'small', 'source', 'span',
        'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot',
        'th', 'thead', 'time', 'tr', 'track', 'u', 'ul', 'var', 'video', 'wbr'];
    // Only attributes supported in HTML5
    protected $attr = [
        'a' => ['href', 'download', 'hreflang', 'media', 'id', 'rel', 'target', 'type'],
        'area' => ['alt', 'coords', 'download', 'href', 'hreflang', 'media', 'rel', 'shape', 'target', 'type'],
        'audio' => ['autoplay', 'controls', 'loop', 'muted', 'preload', 'src'],
        'base' => ['href', 'target'],
        'bdo' => ['dir'],
        'blockquote' => ['cite'],
        'button' => ['autofocus', 'disabled', 'form', 'formaction', 'formenctype', 'formmethod', 'formnovalidate', 'formtarget', 'name', 'type', 'value'],
        'canvas' => ['height', 'width'],
        'col' => ['span'],
        'colgroup' => ['span'], 'del' => ['cite', 'datetime'], 'details' => ['open'],
        'dialog' => ['open'],
        'embed' => ['height', 'src', 'type', 'width'],
        'fieldset' => ['disabled', 'form', 'name'],
        'form' => ['accept-charset', 'action', 'autocomplete', 'enctype', 'method', 'name', 'novalidate', 'target'],
        'iframe' => ['height', 'name', 'sandbox', 'src', 'srcdoc', 'width'],
        'img' => ['alt', 'crossorigin', 'height', 'ismap', 'longdesc', 'sizes', 'src', 'srcset', 'usermap', 'width'],
        'input' => ['accept', 'alt', 'autocomplete', 'autofocus', 'checked', 'dirname', 'disabled', 'form', 'formaction', 'formenctype', 'formmethod', 'formnovalidate', 'formtarget', 'height', 'list', 'max', 'maxlength', 'min', 'multiple', 'name', 'pattern', 'placeholder', 'readonly', 'required', 'size', 'src', 'step', 'type', 'value', 'width'], 'ins', 'kbd', 'keygen', 'label', 'legend',
        'li' => ['value'],
        'link' => ['crossorigin', 'href', 'hreflang', 'media', 'rel', 'sizes', 'type'],
        'map' => ['name'],
        'menu' => ['label', 'type'],
        'meta' => ['charset', 'content', 'http-equiv', 'name'],
        'object' => ['data', 'form', 'height', 'name', 'type', 'usemap', 'width'],
        'ol' => ['reversed', 'start', 'type'],
        'optgroup' => ['disabled', 'label'],
        'option' => ['disabled', 'label', 'selected', 'value'],
        'output' => ['for', 'form', 'name'],
        'param' => ['name', 'value'],
        'progress' => ['max', 'value'],
        'q' => ['cite'],
        'script' => ['async', 'charset', 'defer', 'src', 'type'],
        'select' => ['autofocus', 'disabled', 'form', 'multiple', 'name', 'required', 'size'],
        'source' => ['src', 'srcset', 'media', 'sizes', 'type'],
        'style' => ['media', 'scoped', 'type'],
        'table' => ['sortable'],
        'td' => ['colspan', 'headers', 'rowspan'],
        'textarea' => ['autofocus', 'cols', 'dirname', 'disabled', 'form', 'maxlength', 'name', 'placeholder', 'readonly', 'required', 'rows', 'wrap'],
        'th' => ['abbr', 'colspan', 'headers', 'rowspan', 'scope', 'sorted'],
        'time' => ['datetime'],
        'track' => ['default', 'kind', 'label', 'src', 'scrlang'],
        'video' => ['autoplay', 'controls', 'height', 'loop', 'muted', 'poster', 'preload', 'src', 'width']
    ];
    protected $global = ['accesskey', 'class', 'contenteditable', 'contextmenu', 'data-href', 'dir',
        'draggable', 'dropzone', 'hidden', 'id', 'lang', 'spellcheck', 'style', 'tabindex', 'title', 'translate'];
    public function h1($str, array $options = null)
    {
        return "<h1 " . $this->elements($options) . ">$str</h1>";
    }
    public function h2($str, array $options = null)
    {
        return "<h2 " . $this->elements($options) . ">$str</h2>";
    }
    public function div(array $options = null)
    {
        return "<div " . $this->elements($options) . " ></div>";
    }
    public function span($str, array $options = null)
    {
        return "<span" . $this->elements($options) . ">$str</span:>";
    }
    public function element($name, $str, array $options = null)
    {
        return "<".$this->validateElement($name)." ".$this->elements($options).">$str</".$this->validateElement($name).">";
    }
    public function elements(array $options = null, $element = '')
    {
        return $this->createElement($options, $element);
    }
    protected function createElement(array $args)
    {
        $arr = [];
        foreach ($args as $arg => $val) {
            if(!in_array($arg, $this->global) && !in_array($arg, $this->attr)){
                $this->undefinedElementException($arg);
            }
            if ($val != null || $val != '') {
                $arr[] = "$arg='$val' ";
            }
        }
        return implode('', $arr);
    }
    protected function validateElement($element)
    {
        if(!in_array($element, $this->elements)){
            $this->undefinedElementException($element);
        }
        return $element;
    }
    protected function undefinedElementException($e)
    {
        throw new Exception("Undefined element or attribute '$e'");
    }
}