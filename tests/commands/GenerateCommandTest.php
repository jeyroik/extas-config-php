<?php
namespace tests\stages;

use extas\components\commands\GenerateCommand;
use extas\components\console\TSnuffConsole;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Finder\Finder;

/**
 * Class GenerateCommandTest
 *
 * @package tests\stages
 * @author jeyroik <jeyroik@gmail.com>
 */
class GenerateCommandTest extends TestCase
{
    use TSnuffConsole;

    /**
     * Clean up
     */
    public function tearDown(): void
    {
        $finder = new Finder();
        $finder->name('*.json');

        foreach ($finder->in(__DIR__ . '/../tmp')->files() as $file) {
            unlink($file->getRealPath());
        }
    }

    public function testGenerate()
    {  
        /**
         * @var BufferedOutput $output
         */
        $output = $this->getOutput(true);
        $input = $this->getInput([
            GenerateCommand::OPTION__GENERATE_PATH => __DIR__ . '/../tmp',
            GenerateCommand::OPTION__GENERATE_PATTERN => 'test_extas*'
        ]);

        $command = new GenerateCommand();

        $command->run($input, $output);
        $outputText = $output->fetch();

        $this->assertStringContainsString('Generation done', $outputText);
        $this->assertFileExists(__DIR__ . '/../tmp/test_extas.json');
        $this->assertFileExists(__DIR__ . '/../tmp/test_extas.app.json');
        $this->assertFileExists(__DIR__ . '/../tmp/test_extas.storage.json');
        $this->assertFileExists(__DIR__ . '/../tmp/test_extas.app.storage.json');

        $files = [
            __DIR__ . '/../tmp/test_extas.json',
            __DIR__ . '/../tmp/test_extas.app.json',
            __DIR__ . '/../tmp/test_extas.storage.json',
            __DIR__ . '/../tmp/test_extas.app.storage.json'
        ];

        foreach ($files as $name) {
            // check that php is worked
            $this->assertStringContainsString(10, file_get_contents(__DIR__ . '/../resources/etalon.json', $name));
        }
    }
}
