<?php

namespace Statamic\Addons\TaxonomyFilter;

use Statamic\Extend\Filter;
use Statamic\API\Term;
use Statamic\API\Helper;

class TaxonomyFilterFilter extends Filter
{
  /**
   * Filter a collection based on entries' arrays of taxonomy IDs
   *
   * @return \Illuminate\Support\Collection
   */
  public function filter()
  {
    return $this->collection->filter(function ($entry)
    {

      $tf_group = $this->get('tf_group');
      $tf_slug = $this->get('tf_slug',$this->context['last_segment']);

      $taxonomy_object = Term::whereSlug($tf_slug,$tf_group);
      $the_id = $taxonomy_object->get('id');
      $tf_group_array = Helper::ensureArray($entry->get($tf_group));

      return in_array($the_id,$tf_group_array);

    });
  }
}
