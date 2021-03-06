<?php
namespace FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\Condition\Type;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\AbstractViewHelperTest;

/**
 * Class IsQueryResultViewHelperTest
 */
class IsQueryResultViewHelperTest extends AbstractViewHelperTest
{

    /**
     * @test
     */
    public function rendersThenChildIfConditionMatched()
    {
        $queryResult = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QueryResult',
            array('toArray', 'initialize', 'rewind', 'valid', 'count'),
            array(),
            '',
            false
        );
        $arguments = array(
            'then' => 'then',
            'else' => 'else',
            'value' => $queryResult
        );
        $result = $this->executeViewHelper($arguments);
        $this->assertEquals('then', $result);

        $staticResult = $this->executeViewHelperStatic($arguments);
        $this->assertEquals($result, $staticResult, 'The regular viewHelper output doesn\'t match the static output!');
    }

    /**
     * @test
     */
    public function rendersElseChildIfConditionNotMatched()
    {
        $arguments = array(
            'then' => 'then',
            'else' => 'else',
            'value' => 1
        );
        $result = $this->executeViewHelper($arguments);
        $this->assertEquals('else', $result);

        $staticResult = $this->executeViewHelperStatic($arguments);
        $this->assertEquals($result, $staticResult, 'The regular viewHelper output doesn\'t match the static output!');
    }
}
