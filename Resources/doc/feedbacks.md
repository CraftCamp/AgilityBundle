Feedbacks
========

Services
--------

* [Get project feedbacks](#get-project-feedbacks)
* [Get feedback](#get-feedback)

**Get project features** <a name="get-project-feedbacks"></a>

This service returns all the feedbacks for a given project.

```php
$feedbacks = $this->get('developtech_agility.feedback_manager')->getProjectFeedbacks($project);
```

**Get feature** <a name="get-feature"></a>

This service returns a feedback by its ID.

```php
$feature $this->get('developtech_agility.feedback_manager')->getFeedback($id);
```
