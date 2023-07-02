<?php
namespace extas\components\crawlers;

use extas\components\THasOutput;
use extas\interfaces\IHaveOutput;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CrawlerPHP implements IHaveOutput
{
    use THasOutput;

    protected string $pattern = '';
    protected string $path = '';

    public function __construct(string $pattern, string $pathToSearch)
    {
        $this->pattern = $pattern;
        $this->path = $pathToSearch;
    }

    public function run(string $pathToSave): void
    {
        $finder = new Finder();
        $finder->name($this->pattern . '.php');

        foreach ($finder->in($this->path)->files() as $file) {
            $config = include $file->getRealPath();
            $parts = explode(DIRECTORY_SEPARATOR, $file->getRealPath());

            $packageDir = $pathToSave . DIRECTORY_SEPARATOR . $parts[count($parts)-2];

            if (!is_dir($packageDir)) {
                mkdir($packageDir, 0755);
            }
            file_put_contents($packageDir . '/' . $this->getFileName($file), json_encode($config, JSON_PRETTY_PRINT));
            $this->addToOutput('[OK] Generated config ' . ($config['name'] ?? '<missed name>') . ' ' . $file->getFileName());
            $this->addToOutput('[INFO] see ' . $packageDir . '/' . $this->getFileName($file));
            $this->addToOutput('');
        }
    }

    protected function getFileName(SplFileInfo $file): string
    {
        return str_replace('.php', '.json', basename($file->getRealPath()));
    }
}
