# Switching to SQLite for Render Deployment

This guide explains the changes made to switch the Blazer SOS application from MySQL to SQLite for deployment on Render.

## Why SQLite?

SQLite offers several advantages for this deployment:

1. **Simplicity**: No need to set up and manage a separate database service
2. **Cost-effective**: Eliminates the need for a paid database service
3. **Performance**: For small to medium applications, SQLite can be very fast
4. **Reliability**: SQLite is known for its stability and dependability
5. **Ease of deployment**: Everything is contained in a single file

## Changes Made

1. **render.yaml**:
   - Removed the MySQL database service
   - Changed database connection to SQLite
   - Added persistent disk for SQLite database storage
   - Simplified environment variables

2. **build.sh**:
   - Added SQLite database file creation
   - Set appropriate permissions for the database file

3. **AppServiceProvider.php**:
   - Added configuration for SQLite in production
   - Maintained MySQL configuration for backward compatibility

4. **.env.production**:
   - Updated database connection to SQLite
   - Simplified database configuration

5. **DEPLOYMENT.md**:
   - Updated deployment instructions for SQLite
   - Removed MySQL setup steps
   - Added disk configuration instructions

## Usage Notes

- SQLite works well for small to medium-sized yearbook applications
- The database file is stored on a persistent disk mount at `/var/data/database.sqlite`
- Backups can be made by downloading this file
- For very large applications or high traffic, you may want to consider migrating back to MySQL or PostgreSQL

## Limitations

- SQLite has some limitations compared to full database servers:
  - Less concurrent write capacity (though reads are very fast)
  - No built-in replication or clustering
  - Some advanced SQL features may not be available

## Reverting to MySQL/PostgreSQL

If you need to revert to MySQL or PostgreSQL in the future:

1. Update the `render.yaml` file to include a database service
2. Modify the environment variables to use the database service
3. Export your data from SQLite and import to the new database system
