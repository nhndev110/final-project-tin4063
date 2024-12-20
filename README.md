# final-project-tin4063

## 1. Chú ý khi sử dụng Git / GitHub để làm Team Work

**_1.1._** Tuyệt đối không được push file (đẩy tệp) vào nhành `main` (dù nhành main đã được thiết lập bảo vệ)

**_1.2._** Khi hoàn thành xong chức năng thì thông báo cho **Manager** được biết

**_1.3._** Khi code xong 1 chức năng ở nhành `dev` nếu muốn merge (gộp) vào nhành `main` thì phải tạo 1 `pull request` để **Manager** review (xem xét) lại code xem đã đúng chưa

**_1.4._** **(!!!)** Không làm chung 1 file vì sẽ gây ra `conflict` (xung đột) code. Chỉ làm phần được giao và không đụng vào phần của người khác hay là phần `core` (phần cốt lõi của dự án)

**_1.5._** **(!)** Khi mới có 1 chức năng được hoàn thành, **Manager** sẽ thông báo cho các thành viên lấy code mới từ nhành `main`. Các thành viên sẽ sử dụng lệnh (lúc này đang đứng ở nhành `dev`):

```bash
  git merge main
```

**_1.6._** **(!)** Khi muốn đồng bộ code trên GitHub và dưới `local` (máy mình) thì sử dụng lệnh:

```bash
  git pull
```

**_1.7._** ... (bổ sung sau)

## Quy trình khi push file lên github (Sử dụng VS Code)

### B1:

![image info](./docs/img/training-1.png)

### B2:

![image info](./docs/img/training-2.png)

**hoặc**

![image info](./docs/img/training-3.png)

### B3: Sau khi nhấn add

![image info](./docs/img/training-4.png)

### B4: Push file vào GitHub

![image info](./docs/img/training-5.png)
