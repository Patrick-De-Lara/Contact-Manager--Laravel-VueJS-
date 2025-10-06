#!/bin/bash
set -e

echo "Setting up storage symlink..."

# Remove existing storage link/directory if it exists
if [ -e /app/public/storage ] || [ -L /app/public/storage ]; then
    echo "Removing existing storage link/directory"
    rm -rf /app/public/storage
fi

# Create the symlink
echo "Creating storage symlink"
ln -sf /app/storage/app/public /app/public/storage

# Verify the symlink was created
if [ -L /app/public/storage ]; then
    echo "✓ Storage symlink created successfully"
    echo "  Link: /app/public/storage -> $(readlink /app/public/storage)"
else
    echo "✗ Failed to create storage symlink"
    exit 1
fi

# List contents
echo "Storage directory contents:"
ls -la /app/storage/app/public/ || echo "Storage directory is empty or doesn't exist"

echo "Starting PHP server..."
php -S 0.0.0.0:${PORT:-8000} -t public/