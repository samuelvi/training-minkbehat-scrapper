<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
/**
 * Defines application features from the specific context.
 */
class FeatureContext  extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^I save references in a local storage device$/
     */
    public function iSaveReferencesInALocalStorageDevice()
    {
        $page = $this->getSession()->getPage();
        $content = $page->find('named', array('id', 'mw-content-text'));
        $references = $content->find('css', '.references');
        $items = $references->findAll('css', 'li');
        $links = array();
        foreach ($items as $item) {
           $linkContainer = $item->find('xpath', '//span[@class="reference-text"]');
            $links[] = $linkContainer->find('xpath', '//a/@href')->getText();
        }
        file_put_contents('scrapped_references.txt', join(PHP_EOL, $links));
    }

    public function __call($method, $parameters)
    {
        $page = $this->getSession()->getPage();
        if (method_exists($page, $method)) {
            return call_user_func_array(array($page, $method), $parameters);
        }
    }
    /** @Given /^I save references in a local storage device again$/ */
    public function iSaveReferencesInALocalStorageDeviceAgain()
    {
        $lambda = function($item) { return $item->getText(); };  // anonymous function
        $xpath = '//span[@class="reference-text"]/a/@href';
        $links = array_map($lambda, $this->findAll('xpath', $xpath));
        file_put_contents('scrapped_references_again.txt', join(PHP_EOL, $links));
    }
}




