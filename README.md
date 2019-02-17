# jb_one_to_many
A plugin for Seblod, allowing mapping of data helping complicated searches (like Joomla!'s #__user_usergroup_map table)

# Example
A user can be a teacher
A user can be a student
A teacher can have multiple students...

...In the User form, if the user is a teacher, I can select the users that are students.
In the db e.g. #__cck_store_item_user we have stored:
#__cck_store_item_user.students = "234,345,456, 567"

I might want to map this data (I think is called normalisation where a entry is made for each value)
#__cck_store_free_map.id = Unique ID of entry
#__cck_store_free_map.one_id = ID of teacher
#__cck_store_free_map.one_name = Name for one_id
#__cck_store_free_map.many_id = ID of Student
#__cck_store_free_map.many_name = Name for many_id

So...
id - one_id - one_name - many_id - many_name
1 - 123 - teacher - 234 - student
2 - 123 - teacher - 345 - student
3 - 123 - teacher - 456 - student
4 - 123 - teacher - 567 - student

That is editing a user form the perspective of the user being in the "one" field, rather than in the "many" field.
In other words, are you in the "one" form, or the "many" form?

I might want to update these values from a user in the "many" form, i.e update the teachers for that student.
You set invert to yes, and then it will store the data correctly. Leave the values the same, in the "many" form, the students ID will be used in the "man
y" field, and the Teachers will be looped through and updated accordingly
You can also update the relevant "one" table i.e. #__cck_store_item_user.teachers.

# SETTINGS
### Construction...
Activate Map - Same principle as Seblod's Email field. If never you can override with another field in the form using the same values.

### Global Settings
Storage Event - beforeStore or afterStore
Object - Joomla means not Seblod data, Article, Category, User, User Note, User Group are Seblod Objects, and Free is a Seblod Object based on your custom table.
Depending on Object chosen determines the values required, including Table, Primary Key of Table, Content Type (Form).
Field One ID - the name in the table used to store the "One" ID.
Field One Name - the name in the table used to store the "One" Name.
Field Many ID - the name in the table used to store the "Many" ID.
Field Many Name - the name in the table used to store the "Many" Name.
Invert - Ifin the "one" form, leave as "No". If in the "Many" form, set to "Yes".
Separator - the separator used in your "many" values. This is required to split the string in to an array

### One
Array One - $fields, $config, $cck, value, where is the data coming from i.e $fields[#value1#]->#value2#; as in $fields['user_id']->value
One ID value1 - the first value i.e. user_id
One ID value2 - the second value i.e. value
Value for "One" name - the word you want to enter in the db for one_name

### Many
Array Many - $fields, $config, $cck, value, where is the data coming from i.e $fields[#value1#]->#value2#; as in $fields['students']->value
Many ID value1 - the first value i.e. students
Many ID value2 - the second value i.e. value
Value for "Many" name - the word you want to enter in the db for many_name

### Update
Update Other - If required, update the other table, whether you are in the one or many form.
Object - User etc.... currently this is only working with Seblod Data
Content Type (form) - select the Content Type to update
Field - determine the field (column in db) to update in that content type
