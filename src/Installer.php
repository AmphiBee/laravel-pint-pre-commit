<?php

namespace AmphiBee\LaravelPintPreCommit;

class Installer
{
    const FETCH_URL = "https://gist.githubusercontent.com/ogorzalka/2d355e35c9308cd274ce3232de4cd19c/raw/570166574382b71c59e8803d7343143979d13c61/pre-commit.sh";

    public function install()
    {

        if (!$this->checkGitHookDir())
        {
            throw new \Exception("Not a git repository");
        }
        else
        {
            copy(Installer::FETCH_URL, $this->getGitHookDir() . DIRECTORY_SEPARATOR . 'pre-commit');
            shell_exec("chmod +x " . $this->getGitHookDir() . DIRECTORY_SEPARATOR . 'pre-commit');
        }
    }

    private function getGitHookDir()
    {
        $currentDir = dirname(__FILE__);
        $projectDir = $currentDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..';
        return $projectDir . DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR . 'hooks';
    }

    private function checkGitHookDir()
    {
        return is_dir($this->getGitHookDir());
    }
}
