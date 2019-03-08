<?php

namespace App\Common;

class Dom
{

    private $tag;
    private $content;
    private $feature;
    private $end;
    private $greedy = false;




    public function all()
    {
        $preg = $this->preg();
        var_dump($preg);
        preg_match_all($preg,$this->content,$match);
        $this->setParam();
        $this->greedy = false;
        return $match[1];
    }

    public function row()
    {
        return current($this->all());
    }



    public function setParam($content = '',$tag = '', $feature = '',$end = '')
    {
        $this->setTag($tag);
        $this->setFeature($feature);
        $this->setContent($content);
        $this->setEnd($end);
        return $this;
    }


    public function preg()
    {
        $start  =   $this->feature ? "<{$this->tag}[\s\S]*?{$this->feature}[\s\S]*?>" : "<{$this->tag}[\s\S]*?>";
        $end    =   $this->end ? $this->end : "<\/{$this->tag}>";
        $center =   $this->greedy ? "([\s\S]*?)" : "([\s\S]+)";
        return "/{$start}{$center}{$end}/";
    }


    /**
     * @param mixed $tag
     */
    public function setTag($tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @param mixed $feature
     */
    public function setFeature($feature): void
    {
        $this->feature = $feature;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end): void
    {
        $this->end = $end;
    }

    public function setGreedy($greedy)
    {
        $this->greedy = $greedy;
    }


}