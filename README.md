# TaxonomyFilter for Statamic (v2)

Filter a collection based on entries' arrays of taxonomy IDs.

So much thanks to [@edalzell](https://github.com/edalzell)!

## Installation

1. Move the `statamic-TaxonomyFilter` folder to `site/addons/TaxonomyFilter` (removing the `statamic-` bit)
2. `cd` into your site's directory.
3. Run `php please addons:refresh`

## Usage

In your template, use the filter like this:

```
{{ collection:collection_slug
    filter="TaxonomyFilter"
    tf_group="{ taxonomy_group_slug }"
    tf_slug="{ taxonomy_item_slug }"
}}
```

If `tf_slug` is not provided, it defaults to the value of `{{ last_segment }}`.

## Example

Say you have a collection with the slug `events` and you want to filter them based on a related Taxonomy that has the slug `events-categories`.

In each `event` entry, you would have an array with the same name as the Taxonomy's slug, `events-categories` like this:

```
events-categories:
  - 820aea27-1925-44a0-8819-ac12f4a9e0a7
  - 6594680e-3a94-4e54-a4ad-aa031995af66
  - 0246bd34-ef66-4c4c-8191-98461b58a215
```

… where each of those IDs matches-up with IDs in the `events-categories` Taxonomy.

In my use case, I'm trying to filter based on the URI `/events/categories/summer`, grabbing only (upcoming) events tagged as "summer".

### Template

```
{{ collection:events
    filter="TaxonomyFilter"
    tf_group="events-categories"
    tf_slug="{ slug }"
    sort="date:asc"
    show_future="yes"
    show_past="no"
    as="events"
}}
  {{ unless no_results }}
    <h2>
      <small>Upcoming events tagged:</small><br>
      {{ slug|deslugify }}
    </h2>
    {{ events }}
      {{ partial:calendar/item }}
    {{ /events }}
  {{ else }}
    <p>
      It seems there are no upcoming events
      in the category "<strong>{{ slug|deslugify }}</strong>"
    </p>
  {{ /unless }}
{{ /collection:events }}
```
