Extra simple filter to test that format_text and format_string are used properly.

Enable this filter for both Content and Headings. After that all strings and texts
will have a prefix:
- C - if filter is called for course level context
- F - frontpage context
- M - module
- B - block
- U - user
- S - system
- G - course category

If string or text has additional prefix * it means that the context was not
specified in the call to format_text or format_string and it is taken from $PAGE->context

You can check that:
- filters are applied
- filters are applied on the correct context level
- filters are applied only once (there is only one prefix)