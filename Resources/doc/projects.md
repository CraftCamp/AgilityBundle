Projects
========

Projects are linked to the products you want to create.

Each one represents a product, with its features, its feedbacks, and the whole project management lies on this object.

A project is managed by the product owner, who has a capital place inside the project team.

It will be also the mean to organize beta tests with dedicated accounts in later versions.

Model
-----

* id (integer)
* name (string)
* slug (string)
* description (string)
* createdAt (DateTime)
* productOwner (UserInterface)
* betaTests (Doctrine\Common\Collections\ArrayCollection)
* features (Doctrine\Common\Collections\ArrayCollection)
* feedbacks (Doctrine\Common\Collections\ArrayCollection)

Services
--------

* [Get projects](#get-projects)
* [Get project](#get-project)
* [Create project](#create-project)
* [Edit project](#edit-project)

**Get projects** <a name="get-projects"></a>

This service returns the list of the created projects.

```php
$this->get('developtech_agility.project_manager')->getProjects();
```

**Get project** <a name="get-project"></a>

This service returns one project by slug.

If the slug is not associated to any existing project, an ``NotFoundHttpException`` is thrown.

```php
$this->get('developtech_agility.project_manager')->getProject('greatest-project-ever');
```

**Create project** <a name="create-project"></a>

This service creates a new project.

You must give it the following parameters :

* The project name
* The product owner. It must be an ``User`` class implementing ``UserInterface``

This method will return the created ``Project`` object.

```php
$project = $this->get('developtech_agility.project_manager')->createProject('Great project', $user);
```

**Edit project** <a name="edit-project"></a>

This service edits an existing project.

The service arguments are :

* The project ID
* The project name
* The product owner (can be null)

This method will return the updated ``Project`` object.

```php
$project = $this->get('developtech_agility.project_manager')->editProject(1, 'Great project');
```
