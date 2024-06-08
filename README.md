# spt-auth
Thực nghiệm với authentication với 2 trường hợp login với session và với token
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
