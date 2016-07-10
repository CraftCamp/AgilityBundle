DevelopTech Agility Bundle
==========================

Introduction
------------

This Symfony bundle is meant to implement a full project-management tool inside your application.

It contains all the needed features to manage a project, with its user stories, its tasks, its sprints, its feedbacks...

This tool is designed to handle Agile projects. It is meant for scrum masters, product owners and of course developers.

The purpose of this project is to make easier the usage of Agile ways in a project, and to help end-users to receive feedbacks from their final users.

It is designed to handle beta tests, sprints, engagements, costings and whatever part of the Agile way of work.

Install
-------

As any Symfony bundle, you can install this one using composer :

```
composer require developtech/agility-bundle
```

Then, just enable the bundle in your AppKernel file.

```php
<?php
class AppKernel extends Kernel {
    public function registerBundles() {
        $bundles = [
            // ...
            new DevelopTech\AgilityBundle\DevelopTechAgilityBundle()
        ];
    }
}
```

Some of the bundle entities must be mapped to your user class.

That's why you must extend some classes to use them, like projects.

```php

namespace AppBundle\Entity;

use DevelopTech\AgilityBundle\ProjectModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Project extends ProjectModel {
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $productOwner;
}

```

Now you're done, you can use it the way you want !

Documentation
-------------

* [Projects](Resources/doc/projects.md)