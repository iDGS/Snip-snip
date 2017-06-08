Snip-snip works under Statamic v2 to truncate markdown-formatted content at X number of words (e.g., 50), and close any open tags, so un-closed formatting does not affect "downwind" summaries.

Put it in `/site/addons/SnipSnip/` as `SnipSnipModifier.php`

Use it as, e.g., `{{ content|snip_snip:50 }}{{# NB. ending ellipsis and [MORE] etc. edited w/in snip_snip itself  #}}`

Note that I DID NOT WRITE THE ORIGINAL, which under Statamic v1 was named `word_truncate`. I'd give credit to whoever did, if I could only remember where I got it!

Note also that I hacked the code to include my own ellipsis `…` and `[MORE]` code; so you should likewise modify it to suit YOUR OWN needs.

Snip-snip is provided AS-IS, without license, support, guarantee, warranty, liability or any of that stuff. You're totally on your own. (I doubt I could help, in any case.)
