Extra simple filter to test that format_text and format_string are used properly.

Enable this filter for both Content and Headings. After that all strings and texts
will have a prefix:
C - if filter is called for course level context
M - module
B - block
U - user
S - system
G - course category

You can check that:
- filters are applied
- filters are applied on the correct context level
- filters are applied only once (there is only one prefix)