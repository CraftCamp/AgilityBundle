Projects
========

Services
--------

* [Get projects](#get-projects)

**Get projects** <a name="get-projects"></a>

This service returns the list of the created projects.

```php
$this->get('Developtech_agility.project_manager')->getProjects();
```

**Get project** <a name="get-project"></a>

This service returns one project by slug.

If the slug is not associated to any existing project, an HttpNotFoundException is thrown.

```php
$this->get('Developtech_agility.project_manager')->getProject('greatest-project-ever');
```
