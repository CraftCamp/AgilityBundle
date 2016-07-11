Projects
========

Services
--------

* [Get projects](#get-projects)
* [Get project](#get-project)
* [Create project](#create-project)

**Get projects** <a name="get-projects"></a>

This service returns the list of the created projects.

```php
$this->get('developtech_agility.project_manager')->getProjects();
```

**Get project** <a name="get-project"></a>

This service returns one project by slug.

If the slug is not associated to any existing project, an HttpNotFoundException is thrown.

```php
$this->get('developtech_agility.project_manager')->getProject('greatest-project-ever');
```

**Create project** <a name="create-project"></a>

This service create a new project.

You must give it the following parameters :

* The project name
* The product owner. It must be an ``User`` class implementing ``UserInterface``

This method will return the created ``Project`` object.

```php
$project = $this->get('developtech_agility.project_manager')->createProject('Great project', $user);
```
