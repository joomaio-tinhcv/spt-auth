# spt-auth


# Thực nghiệm với authentication 
1. Login session bằng username và password

endpoint: http://localhost/login

- Trường hợp login success:

username: admin

password: 123123

- Trường hợp login failed:

username: admin

password: 123456

2. Login token bằng access_token với api
- API lấy danh sách users
    + Trường hợp request accept: http://localhost/api/users?access_token=2ieDh4IfHERrlygqb8K3REbKDhPUPYSMjyQz0wQCOq4koGOOmcilb96xgWjceI55
    + Trường hợp request denied: http://localhost/api/users?access_token=2ieDh4IfHERrlygqb8
- API lấy chi tiết user
    + Trường hợp request accept: http://localhost/api/user/1?access_token=2ieDh4IfHERrlygqb8K3REbKDhPUPYSMjyQz0wQCOq4koGOOmcilb96xgWjceI55
    + Trường hợp request denied: http://localhost/api/user/1?access_token=2ieDh4IfHERrlygqb8


# Thực nghiệm với authorization
1. Permission theo access key cua user group
- Trường hợp được add access key
user: admin / 123123 - user group: Super

endpoint: http://localhost/users 

- Trường hợp được không add access key
user: tester1 / 123123 - user group: Creator

endpoint: http://localhost/users 

2. Permission theo attribute của object (Post)

- Trường hợp post được tạo bởi User
user: tester1 / 123123 - user group: Creator

endpoint: http://localhost/post/3

- Trường hợp post không được tạo bởi User
user: tester1 / 123123 - user group: Creator

endpoint: http://localhost/post/1
