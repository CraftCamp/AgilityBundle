Developtech Agility Bundle
==========================

[![Build Status](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/DevelopTech/AgilityBundle/?branch=master)

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
composer require Developtech/agility-bundle
```

Then, just enable the bundle in your AppKernel file.

```php
<?php
class AppKernel extends Kernel {
    public function registerBundles() {
        $bundles = [
            // ...
            new Developtech\AgilityBundle\DeveloptechAgilityBundle()
        ];
    }
}
```

Some of the bundle entities must be mapped to your user class.

That's why you must extend some classes to use them, like projects.

```php
// AppBundle\Entity\Project.php
namespace AppBundle\Entity;

use Developtech\AgilityBundle\ProjectModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Project extends ProjectModel {
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $productOwner;

    /**
     * @var ArrayCollection
     *
     * The feature class you extended
     * It is not mandatory to create a bi-directional relationship between projects and features
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserStory", mappedBy="project")
     */
    protected $features;
}

```

```php
// AppBundle\Entity\UserStory.php
namespace AppBundle\Entity;

use Developtech\AgilityBundle\FeatureModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class UserStory extends FeatureModel {
    /**
     * @var UserInterface
     *
     * The user story responsible
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $developer;

    /**
     * @var Project
     *
     * The project class you extended
     * It is not mandatory to create a bi-directional relationship between projects and features
     * @ManyToOne(targetEntity="AppBundle\Entity\Project", inversedBy="features")
     */
    protected $project;
}

```

Now you're done, you can use it the way you want !

Documentation
-------------

* [Projects](Resources/doc/projects.md)
