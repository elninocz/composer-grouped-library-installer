<?php

namespace Koubas\Composer\Installer;


use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class GroupedLibraryInstaller extends LibraryInstaller
{
    public function __construct(IOInterface $io, Composer $composer, $type = 'library')
    {
        parent::__construct($io, $composer, $type);
    }

    public function getInstallPath(PackageInterface $package)
    {
        $pkgNameParts = explode('/',  $package->getName());
        $words = explode('-', end($pkgNameParts));
        $dirName = '';
        foreach ($words as $word) {
            $dirName .= ucfirst($word);
        }
        return "module/$dirName";
    }

    public function supports($packageType)
    {
        return 'koubas-grouped-library' === $packageType;
    }
}
