# TaxonomyFilter for Statamic (v2)

Filter a collection based on entries' arrays of taxonomy IDs.

## Installation

1. Move the `statamic-TaxonomyFilter` folder to `site/addons/TaxonomyFilter` (removing the `statamic-` bit)
2. `cd` into your site's directory.
3. Run `php please addons:refresh`

## Usage

In your template, use the filter like this:

```
{{ collection:collection_slug filter="TaxonomyFilter" tf_group="{ taxonomy_group_slug }" tf_slug="{ taxonomy_item_slug }" }}
```

If `tf_slug` is not provided, it defaults to the value of `{{ last_segment }}`.
