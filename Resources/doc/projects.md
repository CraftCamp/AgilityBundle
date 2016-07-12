Projects
========

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
* The Beta test status ('open' or 'closed')
* The number of beta testers
* The product owner (can be null)

This method will return the updated ``Project`` object.

```php
$project = $this->get('developtech_agility.project_manager')->editProject(1, 'Great project', 'open', 10);
```
