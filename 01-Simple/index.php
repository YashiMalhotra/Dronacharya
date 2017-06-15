<?php
// index.php 20150101 - 20170302
// Copyright (C) 2015-2017 Mark Constable <markc@renta.net> (AGPL-3.0)


echo new class
{
    private
    $in = [
        'm'     => 'home',      // Method action
    ],
    $out = [                    // $out is an Associative array having key value pairs
        'doc'   => 'SPE::01',
        'nav1'  => '',
        'head'  => 'Simple',
        'main'  => '<p>Error: missing page!</p>',
        'foot'  => 'Copyright (C) 2015-2017 Mark Constable (AGPL-3.0)',
    ],
    $nav1 = [                    //$nav1 is 2-D array.
        ['Home', '?m=home'],
        ['About', '?m=about'],
        ['Contact', '?m=contact'],
    ];

    public function __construct()
    {
        $this->in['m'] = $_REQUEST['m'] ?? $this->in['m'];
        if (method_exists($this, $this->in['m']))
            $this->out['main'] = $this->{$this->in['m']}();
        foreach ($this->out as $k => $v)
            $this->out[$k] = method_exists($this, $k) ? $this->$k() : $v;
    }

    public function __toString() : string     // __toString() overrides the operator that is called when you print objects of the class
    {
        return $this->html();
    }

    private function nav1() : string    /*nav1() is a function with return type value as string to return navigation links*/
    {
        return '
      <nav>' . join('', array_map(function ($n) {
            return '
        <a href="' . $n[1] . '">' . $n[0] . '</a>';
        }, $this->nav1)) . '
      </nav>';
    }

    private function head() : string    /*head() is a function with return type string to provide header with values in OUT array*/
    {
        return '
    <header>
      <h1>' . $this->out['head'] . '</h1>' . $this->out['nav1'] . '
    </header>';
    }

    private function main() : string    /*main() is a function with string return type which will pass main message from OUT array........the message must be unique because of <main> html tag*/
    {
        return '
    <main>' . $this->out['main'] . '
    </main>';
    }

    private function foot() : string    /*foot() function have a string return type to provide footer with values in out array*/
    {
        return '
    <footer>
      <p><em><small>' . $this->out['foot'] . '</small></em></p>
    </footer>';
    }

    private function html() : string /*html() function have return type string to provide basic syntax of html file with meta unicode information and specified viewport*/
    {
        extract($this->out, EXTR_SKIP);
        return '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>' . $doc . '</title>
  </head>
  <body>' . $head . $main . $foot . '
  </body>
</html>
';
    }

    private function home() { return '<h2>Home Page</h2><p>Lorem ipsum home.</p>'; }
    private function about() { return '<h2>About Page</h2><p>Lorem ipsum about.</p>'; }
    private function contact() { return '<h2>Contact Page</h2><p>Lorem ipsum contact.</p>'; }
};
