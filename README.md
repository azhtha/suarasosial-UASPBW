# suarasosial-UASPBW

## Supabase Storage on Railway

Program images use the disk configured by `PROGRAM_IMAGE_DISK`. For production,
create S3 credentials in Supabase under **Storage > S3** and configure Railway:

```env
PROGRAM_IMAGE_DISK=s3
AWS_ACCESS_KEY_ID=<Supabase S3 access key ID>
AWS_SECRET_ACCESS_KEY=<Supabase S3 secret access key>
AWS_DEFAULT_REGION=<region shown in Supabase S3 settings>
AWS_BUCKET=suarasosial-bucket
AWS_USE_PATH_STYLE_ENDPOINT=true
AWS_ENDPOINT=https://<project-ref>.storage.supabase.co/storage/v1/s3
AWS_URL=https://<project-ref>.supabase.co/storage/v1/object/public/suarasosial-bucket
```

`AWS_URL` may also contain only `https://<project-ref>.supabase.co`; the
application will append the public object path and `AWS_BUCKET` automatically.

Do not use the Supabase anon key or service-role JWT as S3 credentials. After
changing Railway variables, redeploy the application so Laravel reloads its
configuration. The application also upgrades the legacy
`https://<project-ref>.supabase.co/storage/v1/s3` endpoint to Supabase's direct
storage hostname for backward compatibility.
