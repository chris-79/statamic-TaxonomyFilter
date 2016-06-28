<?php

namespace Statamic\Addons\TaxonomyFilter;

use Statamic\Extend\Filter;
use Statamic\API\TaxonomyTerm;

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

      $tf_slug = $this->get('tf_slug',$this->context['last_segment']);
      $taxonomy_object = TaxonomyTerm::getFromTaxonomy($this->get('tf_group'),$tf_slug);
      $the_id = $taxonomy_object->get('id');

      return in_array($the_id,$entry->get($this->get('tf_group')));

    });
  }
}
